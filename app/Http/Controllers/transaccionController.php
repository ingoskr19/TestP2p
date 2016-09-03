<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request as request;
use Illuminate\Support\Facades\View;
use p2p\P2P;

class transaccionController extends Controller
{
    public function get(){

        $object = new P2P();
        $transacciones = $object::getTransacciones();
        return view('transacciones', array('transacciones'=>$transacciones));
    }

    public function getListBanks() {
        $object = new P2P();
        $login = '6dd490faf9cb87a9862245da41170ff2';
        $tranKey = '024h1IlD';
        $wsdl = 'https://test.placetopay.com/soap/pse/?wsdl';
        $object::createAuth($wsdl,$login,$tranKey,null);
        
        return $object::getListBanks();

    }

    public function crearTransaccion(Request $request) {
        $login = '6dd490faf9cb87a9862245da41170ff2';
        $tranKey = '024h1IlD';
        $wsdl = 'https://test.placetopay.com/soap/pse/?wsdl';
        $p2p = new P2P();
        $p2p::createAuth($wsdl, $login, $tranKey,null);
        $banco = $request->input('banco');
        $monto = $request->input('mount');
        $reference = $request->input('reference');
        $tipo = $request->input('tipo');
        $buyer = [
            'document' => '1066573122', 'documentType' => 'CC',
            'firstName' => 'buyer',     'lastName' => 'buyer primero',
            'company' => 'P2P1',   'emailAddress' => 'buyer1@gmail.com',
            'address' => 'Medellin buyer 1',  'city' => 'Medellin',
            'province' => 'Antioquia',  'country' => 'Colombia',
            'phone' => '4160050', 'mobile' => '3126202539'
        ];

        $payer = [
            'document' => '1066573123',
            'documentType' => 'CC',
            'firstName' => 'payer',
            'lastName' => 'payer primero',
            'company' => 'p2p2',
            'emailAddress' => 'payer1@gmail.com',
            'address' => 'Mdellin Payer',
            'city' => 'Medellin',
            'province' => 'Antioquia',
            'country' => 'Colombia',
            'phone' => '4160051',
            'mobile' => '3126202531'
        ];

        $shipper = [
            'document' => '1066573124',
            'documentType' => 'CC',
            'firstName' => 'shipper',
            'lastName' => 'shipper primero',
            'company' => 'p2p3',
            'emailAddress' => 'shipper1@gmail.com',
            'address' => 'Medellin Shipper',
            'city' => 'Medellin',
            'province' => 'Antioquia',
            'country' => 'Colombia',
            'phone' => '4160052',
            'mobile' => '3126202532'
        ];

        $buyer = $p2p::createPerson($buyer);
        $payer = $p2p::createPerson($payer);
        $shipper = $p2p::createPerson($shipper);


        $ip = "";

        if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
            $ip = $_SERVER['HTTP_CLIENT_IP'];
        } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
            $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
        } else {
            $ip = $_SERVER['REMOTE_ADDR'];
        }

        $PSETransactionRequest = [
            'bankCode' => $banco,
            'bankInterface' => $tipo,
            'returnURL' => 'http://localhost:8000/verifyEstatus',
            'reference' => $reference, //substr(sha1(mt_rand()),1,10),
            'description' => 'Testing Transaction',
            'language' => 'es',
            'currency' => 'COP',
            'totalAmount' => $monto,
            'taxAmount' => '1000',
            'devolutionBase' => '0',
            'tipAmount' => '0',
            'payer' => $buyer,
            'buyer' => $payer,
            'shipping' => $shipper,
            'additionalData' => null,
            'ipAddress' => '190.168.1.1',
            'userAgent' => substr($_SERVER['HTTP_USER_AGENT'], 0, 254)
        ];
        $p2p::createPSETransactionRequest($PSETransactionRequest);
        $resultado = $p2p::executeTransaction();

        if(isset($resultado['Error'])){
            return view('errorTransaccion', array('errors'=>$resultado['Error']));
        } else {
            return redirect($resultado['Success']);
        }
    }

    public function verifyEstatusTransactionsPost()
    {
        $login = '6dd490faf9cb87a9862245da41170ff2';
        $tranKey = '024h1IlD';
        $wsdl = 'https://test.placetopay.com/soap/pse/?wsdl';
        $p2p = new P2P();
        $p2p::createAuth($wsdl, $login, $tranKey,null);
        $p2p::verifyEstatusTransactions();
        return 1;
    }

    public function verifyEstatusTransactionsGet()
    {
        $login = '6dd490faf9cb87a9862245da41170ff2';
        $tranKey = '024h1IlD';
        $wsdl = 'https://test.placetopay.com/soap/pse/?wsdl';
        $p2p = new P2P();
        $p2p::createAuth($wsdl, $login, $tranKey,null);
        $p2p::verifyEstatusTransactions();
        return redirect('/transacciones');
    }
}
