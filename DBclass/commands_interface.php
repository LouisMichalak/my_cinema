<?php
class DB
{
    private $db_name;
    private $db_host;
    private $db_passwd;
    private $db_login;
    private $pdo;
    public function __CONSTRUCT($db_name = 'cinema',
                                $db_host = 'localhost',
                                $db_passwd = 'Louis001233456',
                                $db_login = 'root')
    {
        $this->db_name = $db_name;
        $this->db_host = $db_host;
        $this->db_passwd = $db_passwd;
        $this->db_login = $db_login;
        $this->pdo = new PDO("mysql:host=$this->db_host;dbname=$this->db_name",
            $this->db_login, $this->db_passwd);
    }
    public function getPDO()
    {
        return $this->pdo;
    }
    public function query($sql_request)
    {
        return $this->pdo->query($sql_request)->fetchAll(PDO::FETCH_ASSOC);
    }
    public function get_id_membre($login)
    {
        $request = "SELECT id_membre FROM membre INNER JOIN fiche_personne ON".
            " membre.id_fiche_perso = fiche_personne.id_perso" .
            " WHERE fiche_personne.email LIKE '".$login."'";
        return($this->query($request));
    }
    public function get_id_perso($login)
    {
        $request = "SELECT id_perso FROM fiche_personne WHERE email LIKE".
            " '".$login."'";
        return ($this->query($request));
    }
    public function get_historique($login)
    {
        $request = "SELECT titre FROM film INNER JOIN historique_membre ON".
            " film.id_film = historique_membre.id_film INNER JOIN membre ON".
            " historique_membre.id_membre = membre.id_membre WHERE".
            " historique_membre.id_membre = "
            . $this->get_id_membre($login)[0]['id_membre'];
        return ($this->query($request));
    }
}
?>