<?php
namespace AppBundle\Controller;
use AppBundle\Form\Type\UserType;
use AppBundle\Entity\User;
use AppBundle\Entity\Client;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class UserController extends Controller{
           
    public function authAction(Request $request) {
        //On regarde si l'utilisateur est deja logé
        $session = $request->getSession();
        
        //Si l'utilisateur est deja logé on le log pas une autre fois
        if( $session->get('isAuth') == 'yes' )
        {
            return $this->redirectToRoute('listproduit',
                    array('message' => 'vous etes deja connecté'));
        }
        
        $user = new User();
        $form = $this->createForm(UserType::class, $user);
        
        // Récupérer les données du form quand il est soumis
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid())
        {
            // Recherche un user correspondant.
            $user = $form->getData();
            $em = $this->getDoctrine()->getManager();

            $key = array("login" => $user->getLogin());
            $order = array('login' => 'ASC');
            $res = $em->find(User::class, $key);
            
            if(count($res) == 1 && $res->getPassword() == $user->getPassword() )
            {
                $session->set('isAuth', 'yes');
                
                //Attribution du role (client ou magasinier
                if( count($em->find(Magasinier::class, $key)) == 1)
                {
                    $session->set('access', 'magasisinier');
                }
                else
                {
                    $session->set('access', 'client');
                }
                
                return $this->redirectToRoute('listproduit');
            }
        }
        // formulaire non valide ou 1er acces : afficher le formulaire
        return $this->render('form/authentification/authentification.html.twig', 
                        array('form'=> $form->createView(),
                            'msg' => "Login ou Mot de passe non valide")) ;
    }       
    
    public function disconnectAction(Request $request)
    {
        $session = $request->getSession()->clear();
        return $this->redirectToRoute('listproduit',
                    array('message' => 'vous etes maintenant déconnecté'));
    }
}