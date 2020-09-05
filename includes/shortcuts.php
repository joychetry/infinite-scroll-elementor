<?php

// Add links in plugins list
function ISE_add_action_links($links) {
    $plugin_shortcuts = array(
		'<a href="https://joychetry.com/infinite-scroll-elementor/#changelog" target="_blank">Changelog</a>',
        '<a href="https://www.buymeacoffee.com/joychetry/" target="_blank" style="color:#3db634;">Buy developer a coffee</a>'
    );
    return array_merge($links, $plugin_shortcuts);
}