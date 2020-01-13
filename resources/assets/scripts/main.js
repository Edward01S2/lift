// import external dependencies
import 'jquery';
import 'lity';

// Import everything from autoload
import './autoload/**/*'

// import local dependencies
import { library, dom } from '@fortawesome/fontawesome-svg-core';
import { faFacebookF, faTwitter, faLinkedinIn, faYoutube } from '@fortawesome/free-brands-svg-icons';

library.add(faFacebookF, faTwitter, faLinkedinIn, faYoutube);
dom.watch();

import Router from './util/Router';
import common from './routes/common';
import home from './routes/home';
import aboutUs from './routes/about';
import postTypeArchiveEvent from './routes/postTypeArchiveEvent';
import singleStory from './routes/singleStory';
import blog from './routes/blog';
import stories from './routes/stories';
import liftInAction from './routes/liftInAction';

/** Populate Router instance with DOM routes */
const routes = new Router({
  // All pages
  common,
  // Home page
  home,
  // About Us page, note the change from about-us to aboutUs.
  aboutUs,
  postTypeArchiveEvent,
  stories,
  singleStory,
  blog,
  liftInAction,
});

// Load Events
jQuery(document).ready(() => routes.loadEvents());
