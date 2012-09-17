<?php
/**
 * @file uom_gshss_custom.webform_options.inc
 * Contains functions that interface with the webform module.
 */

/**
 * Helper to return a list of published program nodes as keyed array.
 */
function uom_gshss_custom_programs_list() {
  $nodes = db_select('node', 'n')
    ->fields('n', array('nid', 'title'))
    ->condition('type', 'program')
    ->condition('status', 0, '<>')
    ->execute()
    ->fetchAll();

  $options = array();
  foreach ($nodes as $node) {
    $options[$node->nid] = check_plain($node->title);
  }
  return $options;
}
