function textMaskAnimation(selector) {
    // Seleciona os itens para animar
    const textElements = document.querySelectorAll(selector);
   
    // Se não tiver nenhum item cancela a função
    if(!textElements) return;
   
    // Cria um fragment de dom (para performance)
    const fragment = document.createDocumentFragment();
  
    // Mascara o elemento com um span envolvendo o conteúdo
    // E outro span logo após o conteúdo, que será a mascara
    function maskElement(element) {
     
      // Cria os elementos de span e define o atributo data-anime
      const spanWrapper = document.createElement('span');
      const spanMask = document.createElement('span');
      spanWrapper.dataset.anime = "textWrapper";
      spanMask.dataset.anime = "textMask";
  
      // Coloca o span dentro do fragmento
      // Coloca o conteúdo do elemento dentro desse span novo
      fragment.appendChild(spanWrapper);
      fragment.firstChild.innerHTML = element.innerHTML;
      fragment.firstChild.appendChild(spanMask);
  
      // Limpa o conteúdo do elemento e em seguida coloca
      // o fragmento de elemento criado
      element.innerHTML = '';
      element.append(fragment);
    }
   
    // Loop pro cada elemento selecionado e mascara eles
    textElements.forEach(element => {
      maskElement(element);
    });
  
    // Ativa a animação adicionando a classe anime a cada
    // elemento que deve ser animado
    function activeAnimation() {
      textElements.forEach((element, index) => {
        // Coloca um timeout para cada elemento,
        // o primeiro ocorre em 350ms, o segundo em 700ms
        // e por ai vai
        setTimeout(() => {
          element.classList.add('anime');
        }, 350 * (index + 1));
      });
    }
   
    // Ativa a animação ao load da página (defina outros eventos se preferir)
    window.addEventListener('load', activeAnimation);
  }
  
  // Ativa a função principal selecionando
  // os elementos que contém data-anime="mask"
  textMaskAnimation('[data-anime="mask"]');