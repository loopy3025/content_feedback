<?php

namespace Drupal\content_feedback\plugin\block;

use Drupal\Core\Block\BlockBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * Provides a 'FeedbackBlock' block.
 *
 * @Block(
 *   id = "feedback_block",
 *   admin_label = "Feedback Block",
 * )
 */

class FeedbackBlock extends BlockBase {
    /*TODO: find user's previous response and set it*/
    public function build(array $form, FormStateInterface $form_state) {
        $form['content_feedback']['information_useful'] = array(
            '#type' => 'checkboxes',
            '#options' => drupal_map_assoc(array(t('Yes'), t('No'))),
            '#title' => t('Was this information useful?'),
        );
        $form['actions'] = [
            '#type' => 'actions',
        ];
        $current_uri = \Drupal::service('path.current')->getPath();
        $form['feedback_url'] = array('#type' => 'hidden', '#value' => $current_uri);
        $form['actions']['submit'] = [
            '#type' => 'submit',
            '#value' => 'Submit',
        ];
        return $form;
    }
    public function submitForm(array &$form, FormStateInterface $form_state)
    {
        $feedback_response = $form_state->getValue('information_useful');
        $feedback_location = $form_state->getValue('feedback_url');
        $feedback_user = \Drupal::currentUser()->id();
        /*TODO: put the $feedback_response in the database*/
        drupal_set_message($this->t('Thanks for your feedback.'));
    }
}