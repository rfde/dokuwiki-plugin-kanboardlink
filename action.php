<?php
/**
 * kanboardlink Action Plugin: Add a toolbar button to insert a link to a Kanboard task
 *
 * @license    MIT (https://opensource.org/licenses/MIT)
 * @author     Till Schlüter <mail@tschlueter.eu>
 */

if (!defined('DOKU_INC')) die();
 
class action_plugin_kanboardlink extends DokuWiki_Action_Plugin { 
    public function register(Doku_Event_Handler $controller) {
        $controller->register_hook('TOOLBAR_DEFINE', 'AFTER', $this, 'insert_button', array ());
    }

    public function insert_button(Doku_Event $event, $param) {
        $event->data[] = array (
            'type' => 'format',
            'title' => 'Task',
            'icon' => '../../plugins/kanboardlink/img/kb.png',
            'open' => 'KB#',
            'close' => '',
            'key' => 'k'
        );
    } 
}
