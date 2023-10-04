<?php

namespace Drupal\mbgna_facility\Form;

use Drupal\Core\Entity\ContentEntityForm;
use Drupal\Core\Form\FormStateInterface;

/**
 * Form controller for the facility entity edit forms.
 */
class FacilityForm extends ContentEntityForm {

  /**
   * {@inheritdoc}
   */
  public function save(array $form, FormStateInterface $form_state) {
    $result = parent::save($form, $form_state);

    $entity = $this->getEntity();

    $logger_arguments = [
      '%label' => $entity->label(),
      'link' => $entity->toLink($this->t('View'))->toString(),
    ];

    switch ($result) {
      case SAVED_NEW:
        $this->messenger()->addStatus($this->t('New facility has been created.'));
        $this->logger('mbgna_facility')->notice('Created new facility %label.', $logger_arguments);
        break;

      case SAVED_UPDATED:
        $this->messenger()->addStatus($this->t('The facility has been updated.'));
        $this->logger('mbgna_facility')->notice('Updated facility %label.', $logger_arguments);
        break;
    }

    $form_state->setRedirect('entity.facility.canonical', ['facility' => $entity->id()]);

    return $result;
  }

}
