import * as bootstrap from 'bootstrap'
import _ from 'lodash'
import axios from 'axios'
import swal from 'sweetalert2'

window._ = _
window.swal = swal
window.bootstrap = bootstrap
window.axios = axios
window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest'
