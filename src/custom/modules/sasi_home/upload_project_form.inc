<?php

function sasi_home_upload_project_form($form, &$form_state) {
  $form['project_bundle'] = array(
    '#type' => 'file',
    '#title' => t('SASI Project Bundle')
  );

  $form['submit'] = array(
    '#type' => 'submit',
    '#value' => t('submit'),
  );

  return $form;
}

function sasi_home_upload_project_form_validate($form, &$form_state) {
  $file = file_save_upload('project_bundle', array(
    'file_validate_extensions' => array()
  ));
  // If the file passed validation:
  if ($file) {
    // Move the file, into the Drupal file system
    if ($file = file_move($file, 'public://')) {
      // Save the file for use in the submit handler.
      $form_state['storage']['project_bundle'] = $file;
    }
    else {
      form_set_error('project_bundle', t('Failed to write the uploaded file the site\'s file folder.'));
    }
  }
  else {
    form_set_error('project_bundle', t('No file was uploaded.'));
  }
}

function sasi_home_upload_project_form_submit($form, &$form_state){
  $file = $form_state['storage']['project_bundle'];
  // We are done with the file, remove it from storage.
  unset($form_state['storage']['project_bundle']);
  // Make the storage of the file permanent
  $file->status = FILE_STATUS_PERMANENT;
  // Save file status.
  file_save($file);
  $file_path = drupal_realpath($file->uri);

  dpm("yo $file_path");

  // Create xtask w/ file as an input argument for run_sasi_task.
  $task_def = array(
    'config' => array(
      'command' => SASI_HOME_TASK_RUNNER_PATH,
      'task' => array(
        'class' => 'georefine.tasks.create_project_task.CreateProjectTask',
        'kwargs' => array(
          'input_path' => $file_path
        )
      )
    ),
    'resolved_callback' => 'sasi_home_upload_project_resolved',
    'completed_page_callback' => 'sasi_home_upload_project_completed_page'
  );
  $node = xtasks_array_to_task($task_def);
  node_save($node);

  // Start running the task.
  xtasks_run_task($node->nid);

  // Go to the task's status page.
  drupal_goto(xtasks_url_for_task_status_page($node->nid, array('absolute' => TRUE)));

}
