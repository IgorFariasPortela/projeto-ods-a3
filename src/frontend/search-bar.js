function searchServices() {
    const query = document.getElementById('search').value;
    const xhr = new XMLHttpRequest();
    xhr.open('GET', `buscar_servicos.php?query=${encodeURIComponent(query)}`, true);
    xhr.onreadystatechange = function() {
      if (xhr.readyState === 4 && xhr.status === 200) {
        document.getElementById('search-results').innerHTML = xhr.responseText;
      }
    };
    xhr.send();
  }
