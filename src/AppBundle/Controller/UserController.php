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
        $mes = '';
        
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
            $res = $em->find(User::class, $key);
            
            if(count($res) === 1 && $res->getPassword() === $user->getPassword() )
            {
                $session->set('isAuth', 'yes');
                
                //Attribution du role (client ou magasinier
                if( count($em->find(Magasinier::class, $key)) === 1)
                {
                    $session->set('access', 'magasinier');
                }
                else
                {
                    $session->set('access', 'client');
                }
                
                return $this->redirectToRoute('listproduit',
                    array('message' => 'Connecté en tant que '
                            . $user->getLogin() . 
                            '(' . $session->get('access') .')' ));
            }
            else
            {
                $mes = "Login ou Mot de passe non valide";
            }
                
        }
        
        // formulaire non valide ou 1er acces : afficher le formulaire
        return $this->render('form/authentification/authentification.html.twig', 
                        array('form'=> $form->createView(),
                            'msg' => $mes)) ;
    }       
    
    public function disconnectAction(Request $request)
    {
        $session = $request->getSession();
        $session->clear();
        return $this->redirectToRoute('listproduit',
                    array('message' => 'vous etes maintenant déconnecté'));
    }
}