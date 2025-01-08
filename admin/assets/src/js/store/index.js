import mitt from 'mitt'

import { registerStore } from '@wordpress/data'

import { EDIT_PRODUCT_STORE_NAME } from '../utils/constants'

// Event emitter instance.
const eventEmitter = mitt()

const initialState = {
    validationErrors: [],
    validationFormValid: true,
}

const actions = {
	addValidationError( pluginName, error ) {
		return {
			type: 'ADD_VALIDATION_ERROR',
			pluginName,
			error,
		}
	},

	clearValidationErrors() {
		return {
			type: 'CLEAR_VALIDATION_ERRORS',
		}
	},

	setValidationFormValid( isValid ) {
		return {
			type: 'SET_VALIDATION_FORM_VALID',
			isValid,
		}
	},

	triggerValidation() {
		eventEmitter.emit( 'validateFields' )

		return {
			type: 'TRIGGER_VALIDATION'
		}
	},
}

const reducer = ( state = initialState, action ) => {
	switch ( action.type ) {
		case 'ADD_VALIDATION_ERROR':
			return {
				...state,
				validationErrors: [
					...state.validationErrors,
					{
						pluginName: action.pluginName,
						error: action.error,
					},
				],
				validationFormValid: false,
			}

		case 'CLEAR_VALIDATION_ERRORS':
			return {
				...state,
				validationErrors: [],
				validationFormValid: true,
			}

		case 'SET_VALIDATION_FORM_VALID':
			return {
				...state,
				validationFormValid: action.isValid,
			}

		default:
			return state
	}
}

const selectors = {
	getEventEmitter() {
		return eventEmitter
	},

	getValidationErrors( state ) {
		return state.validationErrors
	},

	isValidationFormValid( state ) {
		return state.validationFormValid
	},
}

registerStore( EDIT_PRODUCT_STORE_NAME, {
	reducer,
	actions,
	selectors,
} )
