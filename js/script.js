document.querySelector('#addReviewBtn').addEventListener('click', function() {
    let product_id = this.dataset.product_id;
    let user_id = this.dataset.user_id;
    let comment = document.querySelector('#custom_review').value;
    let rating = document.querySelector('#custom_rating').value;
    const formData = new FormData();
    formData.append('comment', comment);
    formData.append('product_id', product_id);
    formData.append('user_id', user_id);
    formData.append('rating', rating);
    fetch("ajax/savereview.php", {
        method: 'POST',
        body: formData
    })
    .then(response => response.json())
    .then(result => {
        let newReview = document.createElement('div');
        newReview.classList.add("review");
        newReview.innerHTML =       
            `
                <div class="review_details">
                    <span class="reviewer_name">Simon</span>
                    <span class="rating"><img src="images/star-solid.svg" alt="rating" class="icon">${result.rating}</span>
                    <span class="review_date">${result.date} </span>
                </div>
                <p class="comment">${result.body}</p>
            `;
        document.querySelector('.reviews').appendChild(newReview);
    })
    .catch(error => {
        console.error("Error:", error);
    });
});
//${result.user_id}