import { EDIT_PRODUCT_STORE_NAME } from '../../utils/constants'

import { __ } from '@wordpress/i18n'

import {
	Button,
	Modal
} from '@wordpress/components'

import {
	useEffect,
	useState,
} from '@wordpress/element'

import {
	dispatch,
	useSelect,
	select
} from '@wordpress/data'

const EditProductValidation = () => {
    const [ isModalOpen, setIsModalOpen ] = useState( false )

	const validationErrors = select( EDIT_PRODUCT_STORE_NAME ).getValidationErrors()

	const eventEmitter = select( EDIT_PRODUCT_STORE_NAME ).getEventEmitter()

	useEffect( () => {
		const updatePostButton = document.getElementById( 'publish' )

		updatePostButton.addEventListener( 'click', handleSaveProduct )

		return () => {
			updatePostButton.removeEventListener( 'submit', handleSaveProduct )
		}
    }, [] )

	useEffect( () => {
		if ( ! select( EDIT_PRODUCT_STORE_NAME ).isValidationFormValid() && validationErrors.length > 0 ) {
			setIsModalOpen( true )
		}
	}, [ validationErrors ] )

	const handleSaveProduct = ( event ) => {
		// Clear existing errors.
		dispatch( EDIT_PRODUCT_STORE_NAME ).clearValidationErrors()

		// Trigger validation.
		dispatch( EDIT_PRODUCT_STORE_NAME ).triggerValidation()

		// Check if the form is valid.
		const isValid = select( EDIT_PRODUCT_STORE_NAME ).isValidationFormValid()

		if ( ! isValid ) {
			event.preventDefault()
			setIsModalOpen( true )
		}
	}

	// Close modal
	const closeModal = () => {
		setIsModalOpen( false )

		dispatch( EDIT_PRODUCT_STORE_NAME ).clearValidationErrors()
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
					{ validationErrors.map( ( error, index ) => (
						<li key={ index }>
							{ error.error }
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

export default EditProductValidation
