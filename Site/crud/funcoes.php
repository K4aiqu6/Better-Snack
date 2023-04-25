<?php

require_once('../config.php');
require_once(DBAPI);

$crud = null;
$crud = null;

/**
 *  Listagem de Clientes
 */
function index() {
	global $crud;
	$crud = find_all('crud');
}

/**
 *  Cadastro de Clientes
 */
function add() {

    if (!empty($_POST['crud'])) {
      
      $today = 
        date_create('now', new DateTimeZone('America/Sao_Paulo'));
  
      $crud = $_POST['crud'];
      $crud['modified'] = $crud['created'] = $today->format("Y-m-d H:i:s");
      
      save('crud', $crud);
      header('location: index.php');
    }
  }

  /**
 *	Atualizacao/Edicao de Cliente
 */
function edit() {

    $now = date_create('now', new DateTimeZone('America/Sao_Paulo'));
  
    if (isset($_GET['id'])) {
  
      $id = $_GET['id'];
  
      if (isset($_POST['crud'])) {
  
        $crud = $_POST['crud'];
        $crud['modified'] = $now->format("Y-m-d H:i:s");
  
        update('crud', $id, $crud);
        header('location: index.php');
      } else {
  
        global $crud;
        $crud = find('crud', $id);
      } 
    } else {
      header('location: index.php');
    }
  }

  /**
 *  Visualização de um Cliente
 */
function view($id = null) {
    global $crud;
    $crud = find('crud', $id);
  }

  /**
 *  Exclusão de um Cliente
 */
function delete($id = null) {

    global $crud;
    $crud = remove('crud', $id);
  
    header('location: index.php');
  }

  ?>