import {
	Fragment,
} from '@wordpress/element'

import EditProductValidation from './EditProductValidation'
import EditProductFieldsWatcher from './EditProductFieldsWatcher'

const EditProductPage = () => {
	return (
		<Fragment>
			<EditProductValidation />
			<EditProductFieldsWatcher />
		</Fragment>
	)
}

export default EditProductPage
