import mitt from 'mitt'

import { registerStore } from '@wordpress/data'

import { EDIT_PRODUCT_STORE_NAME } from '../utils/constants'

// Event emitter instance.
const eventEmitter = mitt()

const initialState = {
    errors: [],
    formValid: true,
}

const actions = {
	reportError( pluginName, message ) {
		return {
			type: 'REPORT_ERROR',
			pluginName,
			message,
		}
	},

	clearErrors() {
		return {
			type: 'CLEAR_ERRORS',
		}
	},

	setFormValid( isValid ) {
		return {
			type: 'SET_FORM_VALID',
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
		case 'REPORT_ERROR':
			return {
				...state,
				errors: [
					...state.errors,
					{
						pluginName: action.pluginName,
						message: action.message,
					},
				],
				formValid: false,
			}

		case 'CLEAR_ERRORS':
			return {
				...state,
				errors: [],
				formValid: true,
			}

		case 'SET_FORM_VALID':
			return {
				...state,
				formValid: action.isValid,
			}

		default:
			return state
	}
}

const selectors = {
	getErrors( state ) {
		return state.errors
	},

	isFormValid( state ) {
		return state.formValid
	},

	getEventEmitter() {
		return eventEmitter
	},
}

registerStore( EDIT_PRODUCT_STORE_NAME, {
	reducer,
	actions,
	selectors,
} )
