<?= "<?php\n" ?>

namespace <?= $namespace ?>;

use <?= $entity_full_class_name ?>;
use <?= $form_full_class_name ?>;
use <?= $form_filter_full_class_name ?>;
<?php if (isset($repository_full_class_name)): ?>
use <?= $repository_full_class_name ?>;
<?php endif ?>
use Doctrine\ORM\EntityManagerInterface;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\<?= $parent_class_name ?>;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

<?php if ($use_attributes) { ?>
#[Route('<?= $route_path ?>')]
<?php } else { ?>
/**
 * @Route("<?= $route_path ?>")
 */
<?php } ?>
class <?= $class_name ?> extends <?= $parent_class_name; ?><?= "\n" ?>
{
<?= $generator->generateRouteForControllerMethod('/index', sprintf('%s_index', $route_name), ['GET']) ?>
<?php if (isset($repository_full_class_name)): ?>
    public function index(<?= $repository_class_name ?> $<?= $repository_var ?>,Request $request, PaginatorInterface $paginator): Response
    {
        $formFilter = $this->createForm(<?= $form_filter_name ?>::class, null,[
                'method' => 'GET',
                'attr' => [
                    'id' => 'idFiltro',
                    'name' => 'filtro',
                    'class' => 'form-group dropdown-menu',

                ]
            ]
        );
        $formFilter->handleRequest($request);
        $filter = $formFilter->isSubmitted() ? $formFilter->getData() : [];

        $<?= $entity_var_plural ?> = $paginator->paginate(
                $<?= $repository_var ?>->get<?= $entity_class_name ?>Filter($filter), /* query NOT result */
                $request->query->getInt('page', 1)/*page number*/,
                20 /*limit per page*/
            );

        return $this->render('<?= $templates_path ?>/index.html.twig', [
            'formFilter' => $formFilter->createView(),
            '<?= $entity_twig_var_plural ?>' => $<?= $entity_var_plural ?>,
        ]);
    }
<?php else: ?>
    public function index(EntityManagerInterface $entityManager): Response
    {
        $<?= $entity_var_plural ?> = $entityManager
            ->getRepository(<?= $entity_class_name ?>::class)
            ->findAll();

        return $this->render('<?= $templates_path ?>/index.html.twig', [
            '<?= $entity_twig_var_plural ?>' => $<?= $entity_var_plural ?>,
        ]);
    }
<?php endif ?>

<?= $generator->generateRouteForControllerMethod('/new', sprintf('%s_new', $route_name), ['GET', 'POST']) ?>
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $<?= $entity_var_singular ?> = new <?= $entity_class_name ?>();
        $form = $this->createForm(<?= $form_class_name ?>::class, $<?= $entity_var_singular ?>);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            try{
                $entityManager->persist($<?= $entity_var_singular ?>);
                $entityManager->flush();
                $this->get('session')->getFlashBag()->add('notice', 'El cambio se realizó correctamente!');
                return $this->redirectToRoute('<?= $route_name ?>_index', [], Response::HTTP_SEE_OTHER);
            } catch (\Doctrine\DBAL\DBALException $DBalEx) {
                $this->get('session')->getFlashBag()->add('error', 'Se ha producido un error en la base de datos!!. '. $DBalEx->getMessage() );
            } catch (\Exception $ex) {
                $this->get('session')->getFlashBag()->add('error', 'Upss! - '.$ex->getMessage());
            }
        }

<?php if ($use_render_form) { ?>
        return $this->renderForm('<?= $templates_path ?>/new.html.twig', [
            '<?= $entity_twig_var_singular ?>' => $<?= $entity_var_singular ?>,
            'form' => $form,
        ]);
<?php } else { ?>
        return $this->render('<?= $templates_path ?>/new.html.twig', [
            '<?= $entity_twig_var_singular ?>' => $<?= $entity_var_singular ?>,
            'form' => $form->createView(),
        ]);
<?php } ?>
    }

<?= $generator->generateRouteForControllerMethod(sprintf('/{%s}', $entity_identifier), sprintf('%s_show', $route_name), ['GET']) ?>
    public function show(<?= $entity_class_name ?> $<?= $entity_var_singular ?>): Response
    {
        return $this->render('<?= $templates_path ?>/show.html.twig', [
            '<?= $entity_twig_var_singular ?>' => $<?= $entity_var_singular ?>,
        ]);
    }

<?= $generator->generateRouteForControllerMethod(sprintf('/{%s}/edit', $entity_identifier), sprintf('%s_edit', $route_name), ['GET', 'POST']) ?>
    public function edit(Request $request, <?= $entity_class_name ?> $<?= $entity_var_singular ?>, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(<?= $form_class_name ?>::class, $<?= $entity_var_singular ?>);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            try{
                $entityManager->flush();
                $this->get('session')->getFlashBag()->add('notice', 'El cambio se realizó correctamente!');

                return $this->redirectToRoute('<?= $route_name ?>_index', [], Response::HTTP_SEE_OTHER);
            } catch (\Doctrine\DBAL\DBALException $DBalEx) {
                $this->get('session')->getFlashBag()->add('error', 'Se ha producido un error en la base de datos!!. '. $DBalEx->getMessage() );
            } catch (\Exception $ex) {
                $this->get('session')->getFlashBag()->add('error', 'Upss! - '.$ex->getMessage());
            }
       }

<?php if ($use_render_form) { ?>
        return $this->renderForm('<?= $templates_path ?>/edit.html.twig', [
            '<?= $entity_twig_var_singular ?>' => $<?= $entity_var_singular ?>,
            'form' => $form,
        ]);
<?php } else { ?>
        return $this->render('<?= $templates_path ?>/edit.html.twig', [
            '<?= $entity_twig_var_singular ?>' => $<?= $entity_var_singular ?>,
            'form' => $form->createView(),
        ]);
<?php } ?>
    }

<?= $generator->generateRouteForControllerMethod(sprintf('/{%s}', $entity_identifier), sprintf('%s_delete', $route_name), ['POST']) ?>
    public function delete(Request $request, <?= $entity_class_name ?> $<?= $entity_var_singular ?>, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$<?= $entity_var_singular ?>->get<?= ucfirst($entity_identifier) ?>(), $request->request->get('_token'))) {
            $entityManager->remove($<?= $entity_var_singular ?>);
            $entityManager->flush();
        }

        return $this->redirectToRoute('<?= $route_name ?>_index', [], Response::HTTP_SEE_OTHER);
    }
}
