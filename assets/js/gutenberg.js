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