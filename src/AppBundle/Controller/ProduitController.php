<?php
namespace AppBundle\Controller;
use AppBundle\Form\Type\ProduitType;
use AppBundle\Entity\Produit;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
class ProduitController extends Controller {
    
    public function listProduitAction($message)
    {
        $em = $this->getDoctrine()->getManager();
        $produits = $em->getRepository(Produit::class)->findBy(array('visible' => true));
        return $this->render('produits/list_produits.twig',
                            ['produits' => $produits, 'msg' => $message]);
    }
    
    public function addProduitAction(Request $request) {
        
        // creer le formulaire
        $personne = new Personne();
        $form = $this->createForm(PersonneType::class, $personne);
        return $this->handleForm($form, $personne, $request);
    }
    
    public function updateProduitAction(Request $request, $nompersonne, $prenompersonne) {
        
        $em = $this->getDoctrine()->getManager();
        // recup en utilisant les 2 colonnes de la cle primaire
        $personne = $em->getRepository(Personne::class)->findById($nompersonne, $prenompersonne);
        $form = $this->createForm(PersonneType::class, $personne);
        
        return $this->handleForm($form, $personne, $request);
    }
    
    private function handleForm($form, Personne $personne, Request $request) {
        // Récupérer les données du form quand il est soumis
        $form->handleRequest($request);
            if ($form->isSubmitted() && $form->isValid()) {
            // enregistrer les donnees dans la base
            $personne = $form->getData();
            $em = $this->getDoctrine()->getManager();
            $em->persist($personne);
            $em->flush();
            // rediriger vers accueil avec un message de succes
            return $this->redirectToRoute('listpersonne', array('message' => 'succès'));
         }
        // formulaire non valide ou 1er acces : afficher le formulaire
        return $this->render('personne/form.twig', 
                             array('form'=> $form->createView())) ;
    }            
}