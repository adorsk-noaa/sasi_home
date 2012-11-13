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
    'file_validate_extensions' => array()
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

function sasi_home_run_sasi_form_submit($form, &$form_state) {
  $file = $form_state['storage']['sasi_bundle'];
  // We are done with the file, remove it from storage.
  unset($form_state['storage']['sasi_bundle']);
  // Make the storage of the file permanent
  $file->status = FILE_STATUS_PERMANENT;
  // Save file status.
  file_save($file);
  $file_path = drupal_realpath($file->uri);

  // Create xtask w/ file as an input argument for run_sasi_task.
  $task_def = array(
    'config' => array(
      'command' => "/home/adorsk/projects/sasi_runner/task_runner.sh",
      'task' => array(
        'class' => 'sasi_runner.tasks.run_sasi_task.RunSasiTask',
        'kwargs' => array(
          'input_file' => $file_path
        )
      )
    )
  );
  $task = xtasks_create_xtask($task_def);

  // Start running the task.
  xtasks_run_task($task->nid);

  // Go to the task's status page.
  drupal_goto(xtasks_url_for_task_status_page($task->nid, array('absolute' => TRUE)));

}
