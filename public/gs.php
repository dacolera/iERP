<?php

ini_set('display_errors',1);
ini_set('display_startup_errors',1);
error_reporting(E_ALL);



	require "../module/Application/src/Application/Entity/" . $_GET['entity'] .".php";

	$entity = "Application\\Entity\\" . $_GET['entity'];


	if(isset($_GET['gs'])){

		$entity = new ReflectionClass($entity);
		$entitySchema = $entity->getProperties();

		foreach ($entitySchema as $campo) {
			$Campo = ucfirst($campo->name);
			$campo = $campo->name;
			$t = '&nbsp;&nbsp;&nbsp;&nbsp;';
			$n = '<br>';
			print "{$t}public function get{$Campo}(){$n}{$t}{{$n}{$t}{$t}return \$this->{$campo};{$n}{$t}}{$n}{$n}";
			print "{$t}public function set{$Campo}(\${$campo}){$n}{$t}{{$n}{$t}{$t}\$this->{$campo} = \${$campo};{$n}{$t}{$t}return \$this;{$n}{$t}}{$n}{$n}";
		}
	} elseif($_GET['setters']) {

		$entity = new ReflectionClass($entity);
		$entitySchema = $entity->getProperties();

		foreach ($entitySchema as $campo) {
			$Campo = ucfirst($campo->name);
			$t = '&nbsp;&nbsp;&nbsp;&nbsp;';
			$n = '<br>';

			print "->set{$Campo}(){$n}";
		}
	}


	exit;	
