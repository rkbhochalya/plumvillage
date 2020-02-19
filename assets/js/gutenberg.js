wp.domReady( () => {
	wp.blocks.unregisterBlockStyle( 'core/pullquote', 'solid-color' );

	wp.blocks.registerBlockStyle('core/pullquote', [
		{
			name: 'default',
			label: 'Default',
			isDefault: true,
		},
		{
			name: 'no-padding',
			label: 'No Padding'
		}
	]);


	wp.blocks.registerBlockStyle('core/cover', [
		{
			name: 'default',
			label: 'Default',
			isDefault: true,
		},
		{
			name: 'align-left',
			label: 'Align Left'
		},
		{
			name: 'with-background',
			label: 'With Background'
		}
	]);


} );



// jQuery Functions for ACF
(function($){

    /**
     * initializeBlock
     *
     * Adds custom JavaScript to the block HTML.
     *
     * @date    15/4/19
     * @since   1.0.0
     *
     * @param   object $block The block jQuery element.
     * @param   object attributes The block attributes (only available when editing).
     * @return  void
     */
    var initializeBlock = function( $block ) {
			$block.find('a').on('click', function(e){
				e.preventDefault();
			})
    }

    // Initialize dynamic block preview (editor).

    if( window.acf ) {
        window.acf.addAction( 'render_block_preview', initializeBlock );
    }

})(jQuery);