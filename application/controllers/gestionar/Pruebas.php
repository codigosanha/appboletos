<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Pruebas extends CI_Controller
{
	public function __construct()
    {
        parent::__construct();
        $this->load->library("EscPos.php");
    }

    public function index(){
    	try {
			// Enter the device file for your USB printer here
			  $connector = new Escpos\PrintConnectors\FilePrintConnector("EPSON20");
				   
				/* Print a Hello world receipt */
				$printer = new Escpos\Printer($connector);
				$printer -> text("Hello World!\n");
				$printer -> cut();

				/* Close printer */
				$printer -> close();
		} catch (Exception $e) {
			echo "Couldn't print to this printer: " . $e -> getMessage() . "\n";
		}
    }
}