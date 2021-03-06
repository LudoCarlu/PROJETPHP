<?php
class Note extends Model {
  public $idN,$idAl,$idU,$note;
  
	public static function getListeFromAlbum( $idAl ) {
		$db = Database::getInstance();
		$sql = "SELECT * FROM note WHERE idAl=".$idAl;
		$stmt = $db->query($sql);
		$stmt->setFetchMode(PDO::FETCH_CLASS, "Note");
		return $stmt->fetchAll();
	}
  
	public static function getListeFromUtilisateur( $id ) {
		$db = Database::getInstance();
		$sql = "SELECT * FROM note N JOIN album A ON (N.idAl = A.idAl) WHERE N.idU=".$id;
		$stmt = $db->query($sql);
		$stmt->setFetchMode(PDO::FETCH_CLASS, "Note");
		return $stmt->fetchAll();
	}
  
  public static function ajouterNote($idAl,$idU,$note) {
    $db = Database::getInstance();
		$sql = "SELECT * FROM note WHERE idAl=".$idAl." AND idU=".$idU;
		$stmt = $db->query($sql);
		$stmt->setFetchMode(PDO::FETCH_CLASS, "Note");
		
		if($res = $stmt->fetch()) {
			$db = Database::getInstance();
			$sql2 = "UPDATE note SET note=$note WHERE idU=$idU AND idAl=$idAl";
			$stmt = $db->query($sql2);
			$stmt->setFetchMode(PDO::FETCH_CLASS, "Note");
		}
		else {
			$db = Database::getInstance();
			$sql2 = "INSERT INTO note (idAl,idU,note) VALUES (:idAl,:idU,:note)";
			$stmt = $db->prepare($sql2);
			$stmt->setFetchMode(PDO::FETCH_CLASS, "Note");
			return $stmt->execute(array(
				':idAl' => $idAl,
				':idU' => $idU,
				':note' =>$note
			));
		}
  }
	/*public static function CalculMoyFromId ($idAl) {
		$db = Database::getInstance();
		//Verification si l'album a une note
		$sql="SELECT * FROM note WHERE idAl=".$idAl;
		$stmt = $db->query($sql);
		$stmt->setFetchMode(PDO::FETCH_CLASS, "Note");
		$res=$stmt->fetch();
		
		//S'il y a une note au moins on calcul la moyenne
		if ($res) {
			$sql = "SELECT AVG(note) as note FROM note WHERE idAl=".$idAl;
			$stmt = $db->query($sql);
			$stmt->setFetchMode(PDO::FETCH_CLASS, "Note");
			$res2=$stmt->fetch();
			//On update la note de l'album
			$sql = "UPDATE album SET note=$res2->note WHERE idAl=$idAl";
			$stmt = $db->query($sql);
			$stmt->setFetchMode(PDO::FETCH_CLASS, "Note");
			$stmt->fetch();
			return $res2;
		}
	}*/
	public static function listeNoteAlbum() {
		$db = Database::getInstance();
		$sql = "SELECT DISTINCT note FROM album ORDER BY note DESC";
		$stmt= $db->query($sql);
		$stmt->setFetchMode(PDO::FETCH_CLASS, "Album");
		return $stmt->fetchAll();
	}
	
}
?>