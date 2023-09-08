<?php

function HeaderEcho($Title, $assets, $itemPlus) {
	$res = '
		<!DOCTYPE html>          
		<html lang="pt-br">
		<head>
	';

	if (is_array($assets)) {
		foreach ($assets as $asset) {
			$type = $asset[0];
			$link = $asset[1];
			$extra = isset($asset[2]) ? $asset[2] : null;

			if ($type == 0) {
				$res .= '<meta ' . $link . '>';
			} elseif ($type == 1) {
				$res .= '<link rel="stylesheet" type="text/css" href="' . $link . '"';
				if ($extra !== null) {
					$res .= ' ' . $extra;
				}
				$res .= '>';
			} elseif ($type == 2) {
				$res .= '<script src="' . $link . '"';
				if ($extra !== null) {
					$res .= ' ' . $extra;
				}
				$res .= '></script>';
			}
		}
	}

	$res .= '
			<link rel="shortcut icon" href="'.$itemPlus.'">
			<title>'.$Title.'</title>
		</head>
	';

	echo $res;
}

function mensage($txt){
    echo '<script>alert("'.$txt.'");</script>';
}

function footEcho(){
    $res = '
        </html>
    ';
    echo($res);
}

function Atalho($pag) {
    header("Location: $pag");
    exit();
}

?>