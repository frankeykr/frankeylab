window.addEventListener("scroll", function () {
    let paginationContainer = document.querySelector('#archive__pagination-next') || null;
    if (paginationContainer) {
        let paginationContainerRect = paginationContainer.getBoundingClientRect();
        let bodyRect = document.body.getBoundingClientRect();
        // archive-works__pagination-containerのy座標(絶対座標)
        let yCoordinateOfPaginationContainer = paginationContainerRect.top - bodyRect.top;

        // マルチブラウザ対応のため、2種類のプロパティから設定されている値を取得する
        let scrollY = document.documentElement.scrollTop || document.body.scrollTop;
        // archive-works__pagination-container が画面内に入ったかどうかの判定ために使う変数
        let scrollYtoDetectPaginationContainerIsVisible = parseInt(scrollY) + window.innerHeight - (bodyRect.top + window.pageYOffset);

        if (yCoordinateOfPaginationContainer < scrollYtoDetectPaginationContainerIsVisible) {
            let nextPageLink = document.querySelector('#archive__pagination-next');
            nextPageLink.removeAttribute('id');
            let nextPageUrl = nextPageLink.getAttribute('href');
            let xhr = new XMLHttpRequest();
            xhr.open("GET", nextPageUrl, true);
            xhr.onreadystatechange = () => {
                if (xhr.readyState === 4 && xhr.status === 200) {
                    let nextPageHtml = xhr.responseText;
                    let div = document.createElement("div");
                    div.innerHTML = nextPageHtml;
                    // works-list__item を works-list に追加する
                    let nextPageWorksListItems = Array.apply(null, div.querySelectorAll(".post-list__item"));
                    nextPageWorksListItems.forEach((nextPageWorksListItem) => {
                        document.querySelector(".post-list").appendChild(nextPageWorksListItem)
                    });
                    // さらに次のページのURLを取得
                    let furtherNextPage = div.querySelector('#archive__pagination-next') || null;
                    if (furtherNextPage) {
                        let worksList = document.querySelector(".post-list");
                        worksList.parentNode.insertBefore(furtherNextPage, worksList.nextSibling);
                    }
                    paginationContainer.parentNode.removeChild(paginationContainer);
                }
            };
            xhr.send();
        }
    }
});