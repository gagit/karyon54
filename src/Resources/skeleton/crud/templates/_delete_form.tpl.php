<form method="post" action="{{ path('<?= $route_name ?>_delete', {'<?= $entity_identifier ?>':
                                    <?= $entity_twig_var_singular ?>.<?= $entity_identifier ?>}) }}"
      onsubmit="return confirm('Estás seguro de borrar este item?');" >
    <input type="hidden" name="_token" value="{{ csrf_token('delete' ~ <?= $entity_twig_var_singular ?>.<?= $entity_identifier ?>) }}">
    <button class="btn  btn-outline-danger">Borrar</button>
</form>
