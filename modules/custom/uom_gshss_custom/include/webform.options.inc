<?php
/**
 * @file uom_gshss_custom.webform_options.inc
 * Contains functions that interface with the webform module.
 */

/**
 * Helper to return a list of published $type nodes as keyed array.
 */
function uom_gshss_custom_node_list($component, $flat, $filter, $type = 'webform') {
  $nodes = db_select('node', 'n')
    ->fields('n', array('nid', 'title'))
    ->condition('type', $type)
    ->condition('status', 0, '<>')
    ->execute()
    ->fetchAll();

  $options = array();
  foreach ($nodes as $node) {
    $options[$node->nid] = check_plain($node->title);
  }
  return $options;
}
