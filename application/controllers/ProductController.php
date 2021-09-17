<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ProductController extends CI_Controller {


    public function AddProductView() 
    {
        $this->load->view('addProductsView');
    }

    public function GalleryView()
    {
        $this->load->view('galleryView');
    }




}



?>