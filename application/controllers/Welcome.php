<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {
	private $textochave;

	public function __construct()
    {
        parent::__construct();
      	$this->textochave = "";
    }
	public function index()
	{
		$this->load->view('welcome_message');
	}


	public function gerartxt(){
		$arquivo = "script.txt";
		
		if($_SERVER['REQUEST_METHOD']=='POST'){
			$textochave = $this->input->post('textochave');
			$textochave2 = $this->input->post('textochave1');
			$this->textoo($textochave, $textochave2);

			//TENTA ABRIR O ARQUIVO TXT
			$fp = fopen($arquivo, "w+");

			//Escreve no arquivo aberto.
			fwrite($fp, trim($this->textochave));

			fclose($fp);

			header('Content-Type: application/octet-stream');
			header('Content-Disposition: attachment; filename='.basename('script.txt'));
			header('Expires: 0');
			header('Cache-Control: must-revalidate');
			header('Pragma: public');
			header('Content-Length: ' . filesize('script.txt'));
			readfile('script.txt');
			exit;


		}


	}

	public function textoo($textochave, $textochave2){
		$novotexto = explode('.', $textochave);

	$this->textochave = "
		service timestamps debug datetime msec
		service timestamps log datetime msec
		service password-encryption
		!
		hostname SW_LJ".$novotexto[0].$novotexto[1]."_01_MG_5
		!
		boot-start-marker
		boot-end-marker
		!
		logging buffered warnings
		logging console warnings
		enable password 7 151E0C0B162B2520083C
		!
		username adm\$cv privilege 15 password 7 1119170613134103092C2E626E
		username nereidas privilege 15 password 7 11271C17121B0F0D170A79747964
		aaa new-model
		!
		!
		aaa group server tacacs+ ACS-TACACS
		 server 172.21.1.51
		!
		aaa authentication login default group tacacs+ local
		aaa authorization exec default group tacacs+ local 
		aaa accounting exec default start-stop group tacacs+
		aaa accounting commands 15 default start-stop group tacacs+
		!
		!
		!
		!
		!
		!
		aaa session-id common
		system mtu routing 1500
		vtp domain CVRJ-2012
		vtp mode transparent
		!
		!
		ip domain-list casaevideo.com.br
		ip domain-name casaevideo.com.br
		ip name-server 172.21.1.252
		ip name-server 172.21.1.251
		!
		!
		!
		spanning-tree mode pvst
		spanning-tree extend system-id
		!
		!
		vlan 10
		 name GERENCIA
		!
		vlan 11
		 name PDV
		!
		vlan 12
		 name LOJA-ESTACOES
		!
		vlan 13
		 name ASSOCIADOS
		!
		vlan 14
		 name PORTABLE
		!
		vlan 15
		 name DEMONSTRACAO
		!
		interface FastEthernet0/1
		 description AP_".$novotexto[0].$novotexto[1]."_01
		 switchport trunk native vlan 10
		 switchport mode trunk
		!
		interface FastEthernet0/2
		 description AP_".$novotexto[0].$novotexto[1]."_02
		 switchport trunk native vlan 10
		 switchport mode trunk
		!
		interface FastEthernet0/3
		 description AP_".$novotexto[0].$novotexto[1]."_03
		 switchport trunk native vlan 10
		 switchport mode trunk
		!
		interface FastEthernet0/4
		 description REP
		 switchport access vlan 12
		!
		interface FastEthernet0/5
		 description DVR
		 switchport access vlan 12
		!
		interface FastEthernet0/6
		 description ALARME
		 switchport access vlan 12
		!
		interface FastEthernet0/7
		 description PRINT CONNECT
		 switchport access vlan 12
		!
		interface FastEthernet0/8
		 description PRINT 85 PV
		 switchport access vlan 12
		!
		interface FastEthernet0/9
		 description PRINT 15 MB
		 switchport access vlan 12
		!
		interface FastEthernet0/10
		 description PRINT CREDITO
		 switchport access vlan 12
		!
		interface FastEthernet0/11
		 description MICRO CREDITO
		 switchport access vlan 12
		!
		interface FastEthernet0/12
		 description MICRO GR
		 switchport access vlan 12
		!
		interface FastEthernet0/13
		 description RETAGUARDA
		 switchport access vlan 12
		!
		interface FastEthernet0/14
		 description RETAGUARDA
		 switchport access vlan 12
		!
		interface FastEthernet0/15
		 description PDV
		 switchport access vlan 11
		!
		interface FastEthernet0/16
		 description PDV
		 switchport access vlan 11
		!
		interface FastEthernet0/17
		 description PDV
		 switchport access vlan 11
		!
		interface FastEthernet0/18
		 description PDV
		 switchport access vlan 11
		!
		interface FastEthernet0/19
		 description PDV
		 switchport access vlan 11
		!
		interface FastEthernet0/20
		!
		interface FastEthernet0/21
		!
		interface FastEthernet0/22
		!
		interface FastEthernet0/23
		!
		interface FastEthernet0/24
		!
		interface GigabitEthernet0/1
		 description LINK PRD - OI
		 switchport mode trunk
		!
		interface GigabitEthernet0/2
		 description LINK BKP - ADSL
		 switchport mode trunk
		!
		interface Vlan10
		 description GERENCIA
		 ip address 10.".$textochave.".5 255.255.255.0
		 no ip route-cache
		!
		ip default-gateway 10.".$textochave.".1
		no ip http server
		ip http secure-server
		logging trap warnings
		snmp-server community col@adm! RO
		snmp-server community public RO
		snmp-server community col@lms!r RO
		snmp-server community col@lms!w RW
		snmp-server community Nereidas@CeV# RO
		snmp-server contact Loja_".$novotexto[0].$novotexto[1]."_{$textochave2}
		tacacs-server host 172.21.1.51 key 7 023224782B053C2A1F77
		tacacs-server directed-request
		!
		!
		!
		banner exec ^CC
		
		**************************************************
		*                 ACESSO RESTRITO                *
		*                                                *
		* O acesso a este equipamento so e permitido com *
		* autorizacao explicita e tal.                   *
		*                                                *
		* Desconecte IMEDIATAMENTE  se  voce nao possui  *
		* autorizacao formal para este acesso e tal.     *
		*                                                *
		*   Toda atividade esta sendo monitorada e tal.  *
		**************************************************
		^C
		banner motd ^CC
		**************************************************
				  Rede Corporativa Empresa Tal
					 Switch SW_LJ".$novotexto[0].$novotexto[1]."_01
			  Responsavel: Equipe TI / TELECOM
		  Desconecte IMEDIATAMENTE  se  voce nao possui
			 autorizacao formal para este acesso.
						  IMPORTANTE
			 Toda atividade esta sendo monitorada.
		**************************************************
		^C
		!
		line con 0
		line vty 0 4
		 password 7 0831424D0D184F181F0D09426C
		line vty 5 15
		 password 7 051B080C254D0406140312544D
		!
		ntp server 172.21.10.1 prefer
		ntp server 10.200.100.234
		end";
	}
}
