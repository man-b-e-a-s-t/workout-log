import { Injectable } from '@angular/core';

@Injectable()
export class LoadingService {

  constructor() { }

  isLoading(isLoading = true) {
    if (isLoading) {
      document.body.classList.add('loading');
    } else {
      document.body.classList.remove('loading');
    }
  }

  isLoadingInnerContent(isLoading = true) {
    const tag = document.getElementsByClassName('main-content');

    if (tag.length > 0 && isLoading) {
      tag[0].classList.add('loading-spin');
    } else if (tag.length > 0) {
      tag[0].classList.remove('loading-spin');
    }
  }
}
