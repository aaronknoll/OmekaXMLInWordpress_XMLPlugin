<?php
add_filter('define_response_contexts', 'ashpxml_response_context');
add_filter('define_action_contexts', 'ashpxml_action_context');

function media_rss_action_context($context, $controller)
{
    if ($controller instanceof ItemsController) {
        $context['browse'][] = 'axml';
    }
    
    return $context;
}

function ashpxml_response_context($context)
{
    $context['axml'] = array('suffix'  => 'axml', 
                            'headers' => array('Content-Type' => 'text/xml'));
    
    return $context;
}

function media_rss_rssm()
{
    $request = Zend_Controller_Front::getInstance()->getRequest();

	if (($request->getControllerName() == 'items' && $request->getActionName() == 'browse') || ($request->getControllerName() == 'index' && $request->getActionName() == 'index')) {
	    return '<link rel="alternate" type="application/rss+xml" title="ASHP Item Feed" href="'.items_output_uri('axml').'" id="ashpxml"/>' . "\n";
	}
}