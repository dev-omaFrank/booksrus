 document.querySelector('form').addEventListener('submit', (e) => {
     e.preventDefault();
     const formData = new FormData(e.currentTarget);
     xhr = '../xhr/search_book.php';
     switch (document.querySelector('input').value !== "") {
         case true:
             async function getData(xhr) {
                 fetch(xhr, {
                         method: 'post',
                         body: formData
                     })
                     .then(response => {
                         if (!response.ok) {
                             throw new Error('Network response was not ok');
                         }
                         return response.json();
                     })
                     .then(data => {
                         console.log('Fetched Data:', data);
                         tableHTML = '';
                         savedHTML = document.querySelector('tbody').innerHTML;
                         for (let key in data) {
                             if (Object.prototype.hasOwnProperty.call(data, key)) {
                                 tableHTML += `
                    <tr>
                      <td>${data[key]['title']}</td>
                      <td>${data[key]['author']}</td>
                      <td>${data[key]['category']}</td>
                      <td>${data[key]['location']}</td>
                      <td>${data[key]['number_of_copies']}</td>
                      <td>${data[key]['status']}</td>
                    </tr>`;
                             }
                         }
                         document.querySelector('tbody').innerHTML = tableHTML;

                         if (document.querySelector('tbody').innerHTML == '') {
                             alert('No data to show');
                             document.querySelector('tbody').innerHTML = savedHTML;
                         }
                     })
                     .catch(error => {
                         console.error('Fetch Error:', error);
                     });
             }
             getData(xhr)
             break;

         default:
             alert('Enter book name to search');
             break;
     }
 })