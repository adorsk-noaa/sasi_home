<?php

function sasi_home_run_sasi_form($form, &$form_state) {
  $form['sasi_bundle'] = array(
    '#type' => 'file',
    '#title' => t('SASI Bundle')
  );

  $form['submit'] = array(
    '#type' => 'submit',
    '#value' => t('Da Submit!'),
  );

  return $form;
}

function sasi_home_run_sasi_form_validate($form, &$form_state) {
  $file = file_save_upload('sasi_bundle', array(
    'file_validate_is_image' => array(), // Validates file is really an image.
    'file_validate_extensions' => array('png gif jpg jpeg'), // Validate extensions.
  ));
  // If the file passed validation:
  if ($file) {
    // Move the file, into the Drupal file system
    if ($file = file_move($file, 'public://')) {
      // Save the file for use in the submit handler.
      $form_state['storage']['sasi_bundle'] = $file;
    }
    else {
      form_set_error('sasi_bundle', t('Failed to write the uploaded file the site\'s file folder.'));
    }
  }
  else {
    form_set_error('sasi_bundle', t('No file was uploaded.'));
  }
}

function sasi_home_test_form_submit($form, &$form_state) {
  $file = $form_state['storage']['sasi_bundle'];
  // We are done with the file, remove it from storage.
  unset($form_state['storage']['sasi_bundle']);
  // Make the storage of the file permanent
  $file->status = FILE_STATUS_PERMANENT;
  // Save file status.
  file_save($file);

  // Set a response to the user.
  drupal_set_message(t('The form has been submitted.'));
}
