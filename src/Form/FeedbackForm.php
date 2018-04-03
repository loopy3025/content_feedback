<?php
namespace Drupal\content_feedback\Form;
use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;

class FeedbackForm extends FormBase {
    public function buildForm(array $form, FormStateInterface $form_state) {
        $form['content_feedback']['information_useful'] = array(
            '#type' => 'checkboxes',
            '#options' => drupal_map_assoc(array(t('Yes'), t('No'))),
            '#title' => t('Was this information useful?'),
        );
        $form['actions'] = [
            '#type' => 'actions',
        ];
        $form['actions']['submit'] = [
            '#type' => 'submit',
            '#value' => 'Submit',
        ];
        return $form;
    }
    public function submitForm(array &$form, FormStateInterface $form_state)
    {
        $feedback_response = $form_state->getValue('information_useful');
        /*TODO: put the $feedback_response in the database*/
        drupal_set_message($this->t('You responded with ' . $feedback_response.'. Thanks for your feedback.'));
    }
}