<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Produits extends CI_Controller{

	function __construct(){
		parent::__construct();
		$this->load->model('produits_model');
		$this->load->model('commentaires');
		$this->load->model('categorie_model');
		$this->load->model('etablissement_model');
		$this->load->model('news_model','news');
		$this->load->model('promo');
		$this->promo->init();
		$this->produits_model->init();
		$this->commentaires->init();
		$this->categorie_model->init();
		$this->etablissement_model->init();
		$this->news->init();
	}
	/*
		Ajoute un nouveau produit à la base de donnée pour l'établissement associé à $this->session->userdata('user_id')
		Ajoute une nouvelle catégorie, si la catégorie envoyer n'existe pas.
	*/
	public function add(){
		if($this->session->userdata('type') > 1){
			$nom = $this->input->post('nom');
			$prix = $this->input->post('prix');
			$description = $this->input->post('description');
			$categorie = $this->input->post('categorie');
			if($categorie =="Select one...")
				$categorie = $this->input->post('categorie_new');
			if($nom && $prix && $description && $categorie){
				$result = $this->categorie_model->get_by_name($categorie);
				if(!$result){ // si la catégorie n'existe pas, on la crée
					$this->categorie_model->insert(array('nom'=>$categorie));
					$result = $this->categorie_model->get_by_name($categorie);
				}
				$etablissement = $this->etablissement_model->get_by_user_id($this->session->userdata('user_id'));
				if($id_produit = $this->produits_model->insert( array ( 'nom' => $nom,
													   'description' => $description,
													   'prix' => $prix,
													   'categorie_id' => $result['id'],
													   'etablissement_id' => $etablissement['id'] ))){
					if(!empty($_FILES)){
						
						$config['upload_path'] = './assets/upload/produit';
						$config['allowed_types'] = 'jpg';
						$config['file_name'] = "produit_".$id_produit;

						$this->load->library('upload', $config);

						if ( ! $this->upload->do_upload("photo")){		
							$data['message'] = $this->upload->display_errors();
							$this->load->view('error',$data);
							return;
						}
					}
					redirect('/index.php/pages/ajouter_produit','location');
				}
				else{
					$data['message'] = $this->mysql->error;
					$this->load->view('error',$data);
				}
			}
			else{
				$data['message'] = 'Veuillez remplir tous les formulaires';
				$this->load->view('error',$data);
			}
		}
		else{
			$data['message'] = 'Vous n\'avez pas les droits pour ajouter un produit';
			$this->load->view('error',$data);
		}
	}
	
	public function delete($id,$etab_id){
		if($this->produits_model->isOwner($id)){
			if($this->produits_model->update(array('deleted'=>true),$id))
				$this->view($etab_id,NULL);
			else{
				$data['message'] = $this->mysql->error;
				$this->load->view('error',$data);
			}	
		}
		else{
			$data['message'] = "Vous n'avez pas les droits pour cette action";
			$this->load->view('error',$data);
		}
	}
	public function ajouter_commentaire(){
		if($this->session->userdata('type') > 0){
			$id_product = $this->input->post('id_product'); // dans un input hidden
			$texte = $this->input->post('texte');
			if($id_product && $texte){
					if($this->commentaires->insert(array( 'texte'=>nl2br($texte), 
													  'produits_id' => $id_product,
													  'user_id' => $this->session->userdata('user_id'))))
						redirect('/index.php/pages/voir_produit/'.$id_product,'location');
					else{
						$data['message'] = $this->mysql->error;
						$this->load->view('error',$data);
					}	
			}
			else{
				$data['message'] = "Veuillez remplir tous les formulaires";
				$this->load->view('error',$data); // Erreur forumulaire incomplet
			}
		}
		else
			redirect('/index.php','location');	
	}
	public function view($etab_id,$filtre = NULL){
		if($this->session->userdata('type') > 0){
		
			
			$etablissements = $this->etablissement_model->search(NULL,NULL ,NULL, NULL, NULL);
		
			$this->load->view('modules/header',array('title' => "iSandwich :: Nos établissements"));
			$i = 0;
			foreach ($etablissements as $etab) {
				$name_array['etablissement'][$i]['name'] = $etab['nom'];
				$name_array['etablissement'][$i]['id'] = $etab['id'];
				
				$i++;
			}
			$name_array['id'] = intval($etab_id);
			$this->load->view('produits/header_produit',$name_array);
			
			$view_id 				= intval($etab_id);
			$selected_etab 			= $this->etablissement_model->get($view_id);
			$news_etab 				= $this->news->search("etablissement_id = $view_id",NULL, NULL, 'date_creation DESC',NULL);
			$data['etablissement'] 	= $selected_etab;
			$data['news'] 			= $news_etab;
			$this->load->view('produits/info_etablissement',$data);
		
			$search_categorie = $this->input->post('categorie');
			$search = $this->input->post('search');
			if(empty($search)) $search = NULL;
			if($search_categorie == 0)$search_categorie = NULL;
			
				
			$produits = $this->produits_model->get_product_list($view_id,$search_categorie, $search);
	
			$dataProduit['produits'] = $produits;
			if(!empty($produits))
				$dataProduit['owner'] = $this->produits_model->isOwner($produits[0]['id']);
			else
				$dataProduit['owner'] = false;
			$categorie = $this->categorie_model->search(NULL,NULL,NULL,NULL,NULL);
			$dataProduit['categorie'] = $categorie;
			$dataProduit['etablissement_id'] = $view_id;
			$this->load->view('produits/tableau',$dataProduit);
			
			$this->load->view('modules/footer');
		}
		else
			redirect('/index.php','location');
	}
	public function ajouter_promo(){
		$promo = $this->input->post('promo');
		$id_product = $this->input->post('id_product');
		$date_debut = $this->input->post('date_debut');
		$date_fin = $this->input->post('date_fin');
		if($promo && $id_product && $date_fin){
			if($this->produits_model->isOwner($id_product)){
				
				if($this->promo->dateUsed($id_product,$date_debut,$date_fin)) {
					$data['message'] = "Vous ne pouvez pas ajouter une promotion qui chavauche une autre.";
					$this->load->view('error',$data);	
					return;
				}	
					
				if($this->promo->insert( array('promo'=> ((100 - $promo) /100),
											   'debut'=>$date_debut,
											   'fin' =>$date_fin,
											   'produits_id' => $id_product)))
					redirect('/index.php/pages/voir_produit/'.$id_product,'location');
				else{
					$data['message'] = $this->mysql->error;
					$this->load->view('error',$data);
				}
			}
			else{
				$data['message'] = "Vous n'avez pas les droits pour cette action";
				$this->load->view('error',$data);		
			}
		}
		else{
			$data['message'] = "Veuillez remplir tous les formulaires";
			$this->load->view('error',$data);			
		}	
	}
	public function del_promo(){
		if($this->produits_model->isOwner($this->input->post('id_product'))){
			$nbr_promo = $this->input->post('nbr_promo');
			for($i = 0; $i<$nbr_promo;$i++){
				$del = $this->input->post('del_'.$i);
				$del_id = $this->input->post('del_'.$i.'_id');
				if($del){
					$this->promo->delete($del_id);
				}
			}
			redirect('/index.php/pages/voir_produit/'.$this->input->post('id_product'),'location');
		}
		else{
			$data['message'] = "Vous n'avez pas les droits pour cette action";
			$this->load->view('error',$data);
		}
	}
	public function disponnibilite(){
		$id_product = $this->input->post('id_product');
		if($this->produits_model->isOwner($id_product)){
			$disponnible = $this->input->post('disponnible');
			if($disponnible == 1){
				$this->produits_model->update(array('disponnibilite' => false),$id_product);
			}else{
				$this->produits_model->update(array('disponnibilite' => true),$id_product);
			}
			redirect('/index.php/pages/voir_produit/'.$id_product,'location');
		}else{
			$data['message'] = "Vous n'avez pas les droits pour cette action";
			$this->load->view('error',$data);
		}
	}
	public function changeOrCreateScore(){
		$this->load->model('score');
		$this->score->init();
		$score = $this->input->post('score');
		$produit_id = $this->input->post('produit_id');
		$this->load->library('json');
		if($score && $produit_id){
			if($score_id = $this->score->scoreAlreadySet($produit_id)){ // on change le score (update)
				if(!$this->score->update( array('score'=>$score), $score_id)){
					$this->load->view('error',array('message'=>$this->mysql->error));
					return;	
				}
				$this->json->setError(0);
				$this->json->call('notification',array("Modification du score réussie"));
			}
			else{ // on crée le score (insert)
				if(!$this->score->insert(array( 'user_id'	 =>$this->session->userdata('user_id'),
											'produit_id' => $produit_id,
											'score'      => $score ))){
					$this->load->view('error',array('message'=>$this->mysql->error));
					return;
				 }
				$this->json->setError(0);
				$this->json->call('notification',array("Ajout de votre score réussi"));
			}
			echo json_encode($this->json->get());
		}
	}
}