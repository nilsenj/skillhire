require('../bootstrap');

function uploadAvatar(formData) {
    const url = `${window.BASE_URL}/api/file/uploadAvatar`;
    let token = document.head.querySelector('meta[name="csrf-token"]');
    window.axios.defaults.headers.common['Authorization'] = 'Bearer ' + localStorage.getItem('id_token');
    return window.axios.post(url, formData)
        // get data
            .then(x => x.data)
        // add url field
        .then(x => x.map(data => Object.assign({},
        data, { url: `${data.image}` })));
}

function uploadResume(formData) {
    const url = `${window.BASE_URL}/api/file/uploadResume`;
    let token = document.head.querySelector('meta[name="csrf-token"]');
    window.axios.defaults.headers.common['Authorization'] = 'Bearer ' + localStorage.getItem('id_token');
    return window.axios.post(url, formData)
    // get data
        .then(x => x.data)
        // add url field
        .then(x => x.map(data => Object.assign({},
            data, { url: `${data.resume}` })));
}

export { uploadAvatar, uploadResume }