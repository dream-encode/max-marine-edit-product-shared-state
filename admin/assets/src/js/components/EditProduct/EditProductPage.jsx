import { EDIT_PRODUCT_STORE_NAME } from '../../utils/constants'

import { __ } from '@wordpress/i18n'

import {
	Button,
	Modal
} from '@wordpress/components'

import {
	useState,
	useEffect,
} from '@wordpress/element'

import {
	dispatch,
	select
} from '@wordpress/data'

const EditProduct = () => {
	const [ isModalOpen, setIsModalOpen ] = useState( false )

	const errors = select( EDIT_PRODUCT_STORE_NAME ).getErrors()

	useEffect( () => {
		const updatePostButton = document.getElementById( 'publish' )

		updatePostButton.addEventListener( 'click', handleSaveProduct )

		return () => {
			updatePostButton.removeEventListener( 'submit', handleSaveProduct )
		}
    }, [] )

	useEffect( () => {
		if ( ! select( EDIT_PRODUCT_STORE_NAME ).isFormValid() && errors.length > 0 ) {
			setIsModalOpen( true )
		}
	}, [ errors ] )

	const handleSaveProduct = ( event ) => {
		// Clear existing errors.
		dispatch( EDIT_PRODUCT_STORE_NAME ).clearErrors()

		// Trigger validation.
		dispatch( EDIT_PRODUCT_STORE_NAME ).triggerValidation()

		// Check if the form is valid.
		const isValid = select( EDIT_PRODUCT_STORE_NAME ).isFormValid()

		if ( ! isValid ) {
			setIsModalOpen( true )
			event.preventDefault()
		}
	}

	// Close modal
	const closeModal = () => {
		setIsModalOpen( false )
		dispatch( EDIT_PRODUCT_STORE_NAME ).clearErrors()
	}

	if ( ! isModalOpen ) {
		return null
	}

	return (
		<Modal
			title={ __( 'Problem Saving Product', 'max-marine-product-categories-enhancements' ) }
			className="mmepss-edit-product-error-modal"
			onRequestClose={ closeModal }
		>
			<div className="content">
				<p>
					{ __( 'Please correct the following errors before saving this product:', 'max-marine-product-categories-enhancements' ) }
				</p>
				<ul>
					{ errors.map( ( error, index ) => (
						<li key={ index }>
							{ error.message }
						</li>
					) ) }
				</ul>
			</div>

			<div className="buttons">
				<Button
					isPrimary
					onClick={ closeModal }
				>
					{ __( 'OK', 'max-marine-product-categories-enhancements' ) }
				</Button>
			</div>
		</Modal>
	)
}

export default EditProduct
