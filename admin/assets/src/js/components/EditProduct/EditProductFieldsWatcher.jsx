import { EDIT_PRODUCT_STORE_NAME } from '../../utils/constants'

import { __ } from '@wordpress/i18n'

import {
	Button,
	Modal
} from '@wordpress/components'

import {
	useState,
	useEffect,
	useRef,
} from '@wordpress/element'

import {
	dispatch,
	select
} from '@wordpress/data'

import useFieldWatcher from '../../hooks/useFieldWatcher'

const FIELDS = [
	{
		id: '_stock',
		event: 'change'
	},
	{
		id: '_regular_price',
		event: 'change'
	},
	{
		id: '_sale_price',
		event: 'change'
	}
]

const EditProductFieldsWatcher = () => {
	const [ isModalOpen, setIsModalOpen ]                         = useState( false )
	const [ modalTitle, setModalTitle ]                           = useState( '' )
	const [ modalContent, setModalContent ]                       = useState( '' )
	const [ modalCancelActionLabel, setModalCancelActionLabel ]   = useState( '' )
	const [ modalConfirmActionLabel, setModalConfirmActionLabel ] = useState( '' )
	const [ modalCancelActionEvent, setModalCancelActionEvent ]   = useState( '' )
	const [ modalConfirmActionEvent, setModalConfirmActionEvent ] = useState( '' )

	const handleFieldChange = ( fieldID, newValue, oldValue ) => {
		switch ( fieldID ) {
			case '_stock':
				switch ( true ) {
					case ( '' === oldValue ||  '0' === oldValue ):
						triggerRelistProductModal()
						break

					case ( parseInt( newValue, 10 ) < parseInt( oldValue, 10 ) ):
						// triggerInventoryReductionModal()
						break
				}
				break
		}
	}

	useFieldWatcher( FIELDS, handleFieldChange )

	const openModal = () => {
		setIsModalOpen( true )
	}

	const closeModal = () => {
		setIsModalOpen( false )
	}

	const triggerRelistProductModal = () => {
		const title         = __( 'Relisting Product', 'max-marine-product-categories-enhancements' )
		const content       = __( 'Are you relisting this product?', 'max-marine-product-categories-enhancements' )
		const cancelLabel   = __( 'No', 'max-marine-product-categories-enhancements' )
		const confirmLabel  = __( 'Yes', 'max-marine-product-categories-enhancements' )

		setModalTitle( title )
		setModalContent( content )
		setModalCancelActionLabel( cancelLabel )
		setModalConfirmActionLabel( confirmLabel )
		setModalCancelActionEvent( 'RelistingProduct' )
		setModalConfirmActionEvent( '' )

		openModal()
	}

	const handleCancelAction = () => {
		if ( ! modalCancelActionEvent || ! eventEmitter ) {
			return
		}

		eventEmitter.emit( modalCancelActionEvent )
	}

	const handleConfirmAction = () => {
		if ( ! modalConfirmActionEvent || ! eventEmitter ) {
			return
		}

		eventEmitter.emit( modalConfirmActionEvent )
	}

	if ( ! isModalOpen ) {
		return null
	}

	return (
		<Modal
			title={ modalTitle }
			className="mmepss-edit-product-error-modal"
			onRequestClose={ closeModal }
		>
			<div className="content">
				<p>
					{ modalContent }
				</p>
			</div>

			<div className="buttons">
				<Button
					isPrimary
					onClick={ handleCancelAction }
				>
					{ modalCancelActionLabel }
				</Button>
				<Button
					isPrimary
					onClick={ handleConfirmAction }
				>
					{ modalConfirmActionLabel }
				</Button>
			</div>
		</Modal>
	)
}

export default EditProductFieldsWatcher
