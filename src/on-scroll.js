const observer = new IntersectionObserver((sections)=>{
    sections.forEach((section)=>{
        if(section.isIntersecting){
            section.target.classList.add('show');
        }
        else{
            section.target.classList.remove('show');
        }
    });
});

const hiddenelements = document.querySelectorAll('.hidden');
hiddenelements.forEach((element)=>{
    observer.observe(element);
});