<form method="post" action="{{ path('<?= $route_name ?>_delete', {'<?= $entity_identifier ?>':
                                    <?= $entity_twig_var_singular ?>.<?= $entity_identifier ?>}) }}"
      onsubmit="return confirm('{{'controller.messages.message_if_confirm_delete'| trans({}, 'controller_messages') }}');" >
    <input type="hidden" name="_token" value="{{ csrf_token('delete' ~ <?= $entity_twig_var_singular ?>.<?= $entity_identifier ?>) }}">
    <button class="btn btn-danger"
            data-toggle="tooltip"
            data-placement="top"
            title="{{'controller.titles.delete_entity'| trans({}, 'controller_messages') }}">
            <i class="fa fa-times"></i>
    </button>
</form>
