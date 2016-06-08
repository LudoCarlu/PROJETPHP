<?php
class Album {
	public $idAl, $idArt, $nomAl, $dateAl, $genre, $note;
  
  function __toString() {
    return $this->nomAl;
  }
	public function getId() {
		return $this->idAl;
	} 
  public function getNomAl() {
		return $this->nomAl;
	} 
  public function getdateAl() {
		return $this->dateAl;
	} 
  public function getGenre() {
		return $this->genre;
	} 
  public function getNote() {
		return $this->note;
	} 
  public function setId($id) {
    $this->idAl = $id;
	}
	public function setNomAl($nom){
    $this->nomAl = $nom;
  }
  public function setDateAl($date){
    $this->dateAl = $date;
  }
  public function setGenre($genre){
    $this->genre = $genre;
  }
  public function setNote($note){
    $this->note = $note;
  }
	
	public static function getFromId( $id ) {
		$db = Database::getInstance();
		$sql = "SELECT * FROM album WHERE idAl = $id";
		$stmt = $db->prepare($sql);
		$stmt->setFetchMode(PDO::FETCH_CLASS, "Album");
		$stmt->execute(array(":id" => $id));
		return $stmt->fetch();
	}
	
	public static function getList() {
	$db = Database::getInstance();
	$sql = "SELECT * FROM album";
	$stmt = $db->query($sql);
	$stmt->setFetchMode(PDO::FETCH_CLASS, "Album");
	return $stmt->fetchAll();
		
	}
	
	
	
	public static function envoyerAlbum($nomAl,$nomArt,$dateAl,$genre) {
		$db = Database::getInstance();
		$sql = "INSERT INTO album (idArt,nomAl,dateAl,genre) VALUES (:idArt,:nomAl,:dateAl,:genre)";
		$stmt = $db->prepare($sql);
		//$stmt->setFetchMode(PDO::FETCH_CLASS, "Artiste");
		echo "Merci pour votre ajout !";
		return $stmt->execute(array(
		 'nomArt' => $nomArt,
		 'nomAl'=>$nomAl,
		 'dateAl'=>$dateAl,
		 'genre'=>$genre
		 ));
 	}
}

?>