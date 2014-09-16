<?php
//
// (c) 2014 by sh4ni.de & catnet.de

function hashCode($s) {
	$s = str_replace( "-", "", trim($s) );
	for( $i=0; $i<4; $i++){
		$sub[$i] = intval( "0x".substr($s,$i*8,8)+0 ,16);
	}
	return ( $sub[0] ^ $sub[1] )^( $sub[2] ^ $sub[3] );
};

if( $_GET["name"] ){
	$json = file_get_contents("https://api.mojang.com/users/profiles/minecraft/" . $_GET["name"]);
	$id = json_decode($json);
	if ( !$id->id ) echo "Error: Can't get UUID from mojang.com";
	elseif( hashCode($id->id)%2) echo "Alex";
	else echo "Steve";
	if ( $id->legacy ) echo "<br>Account not migrated!";
	//echo "<br><br>" . $json;
}
elseif( $_GET["uuid"] ){
	//$json = file_get_contents("https://api.mojang.com/users/profiles/" . $_GET["uuid"] . "/names");
	if( hashCode($_GET["uuid"])%2) echo "Alex";
	else echo "Steve";
	//echo $json;
}
else {
	echo "Use ?uuid=YOUR_UUID";
}
?>
