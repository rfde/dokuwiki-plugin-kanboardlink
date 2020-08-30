<?php
/**
 * kanboardlink Syntax Plugin.
 *
 * Syntax: KB#123 will be replaced with a link to Kanboard Task #123.
 * 
 * @license    MIT (https://opensource.org/licenses/MIT)
 * @author     Till Schlüter <mail@tschlueter.eu>
 */
class syntax_plugin_kanboardlink extends DokuWiki_Syntax_Plugin {
    function getType(){
        return 'substition';
    }  

    function getSort(){
        return 304;
    }
 
    function connectTo($mode) {
        $this->Lexer->addSpecialPattern('KB#\d+', $mode, 'plugin_kanboardlink');
    }
 
    function handle($match, $state, $pos, Doku_Handler $handler){
        switch ($state) {
          case DOKU_LEXER_ENTER:
            break;
          case DOKU_LEXER_MATCHED:
            break;
          case DOKU_LEXER_UNMATCHED:
            break;
          case DOKU_LEXER_EXIT:
            break;
          case DOKU_LEXER_SPECIAL:
            $taskid = trim(substr($match, 3));
            if (is_numeric($taskid)) {
                return array("taskid" => $taskid);
            }
            break;
        }
        return array();
    }

    function render($mode, Doku_Renderer $renderer, $data) {
        if($mode == 'xhtml'){
            if (array_key_exists("taskid", $data)) {
                $link['target'] = '_blank';
                $link['style']  = '';
                $link['pre']    = '';
                $link['suf']    = '';
                $link['more']   = '';
                $link['class']  = '';
                $link['url']    = $this->getConf('baseurl')."?controller=TaskViewController&action=show&task_id=".$data["taskid"];
                $link['name']   = "<span class=\"kanbrdk\">K</span><span class=\"kanbrdb\">B</span>&nbsp;#".$data["taskid"];
                $link['title']  = 'Kanboard Task #'.$data["taskid"];
        
                $renderer->doc .= $renderer->_formatLink($link);
                return true;            
            }
        }
        return false;
    }
}
