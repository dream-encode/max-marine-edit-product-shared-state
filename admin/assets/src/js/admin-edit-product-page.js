import {
	createRoot
} from '@wordpress/element'

import domReady from '@wordpress/dom-ready'

import EditProductPage from './components/EditProduct/EditProductPage.jsx'

import './store/index.js'

domReady( () => {
	const root = createRoot(
		document.getElementById( 'max-marine-edit-product-shared-state' )
	)

	root.render( <EditProductPage /> )
} )
