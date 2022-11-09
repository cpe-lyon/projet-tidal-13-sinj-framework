document.getElementById('title').innerHTML = 'tu tournes Julo';

let title = document.getElementById('title');
let titleclone = title.cloneNode(true)
document.getElementsByTagName('body')[0].appendChild(titleclone);

tutournes();