const video = document.getElementById("myVideo");

// Bắt sự kiện "ended" khi video kết thúc
video.addEventListener("ended", function () {
  // Đặt thời gian video về 0 để nó chạy lại từ đầu
  video.currentTime = 0;
  // Phát video lại tự động
  video.play();
});

// animation

const element = document.getElementById("myElement");

function animateOnIntersection(entries, observer) {
  entries.forEach((entry) => {
    if (entry.isIntersecting) {
      // Nếu phần tử xuất hiện trong tầm nhìn, thêm lớp animation vào phần tử để kích hoạt animation
      element.classList.add("animate__zoomInLeft");
    } else {
      // Nếu phần tử không còn xuất hiện trong tầm nhìn, loại bỏ lớp animation để cho lần kế tiếp xuất hiện lại
      element.classList.remove("animate__zoomInLeft");
    }
  });
}

// Tạo một Intersection Observer
const observer = new IntersectionObserver(animateOnIntersection, {
  threshold: 0.1,
});

// Theo dõi phần tử để kích hoạt animation khi nó xuất hiện trong tầm nhìn
observer.observe(element);
