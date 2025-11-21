/**
 * Test Data - Centralized test configuration
 * KISS: Single source of truth for all test data
 */

const PILLARS = [
  {
    name: 'Tuinen',
    slug: 'tuinen',
    icon: '🌱',
    subtitle: 'Gardens',
    primaryColor: '#97bf85',
    secondaryColor: '#6f9357'
  },
  {
    name: 'Geschiedenis',
    slug: 'geschiedenis',
    icon: '🏛️',
    subtitle: 'History',
    primaryColor: '#c27d55',
    secondaryColor: '#b4412f'
  },
  {
    name: 'Ontmoeting',
    slug: 'ontmoeting',
    icon: '🌊',
    subtitle: 'Meeting',
    primaryColor: '#6ba7b6',
    secondaryColor: '#2a677e'
  },
  {
    name: 'Educatie',
    slug: 'educatie',
    icon: '🎓',
    subtitle: 'Food Education',
    primaryColor: '#f0a85f',
    secondaryColor: '#d97225'
  },
  {
    name: 'Verblijf',
    slug: 'verblijf',
    icon: '🏠',
    subtitle: 'Stays',
    primaryColor: '#d98c8c',
    secondaryColor: '#b35a5a'
  }
];

const LANGUAGES = {
  nl: { code: 'nl', name: 'NL', locale: 'nl_NL' },
  en: { code: 'en', name: 'EN', locale: 'en_US' }
};

const SELECTORS = {
  languageSwitcher: '.language-switcher',
  langLink: '.lang-link',
  langSeparator: '.lang-separator',
  pillarCard: '.pillar-card',
  pillarsGrid: '.pillars-grid',
  navigation: '.site-header-item-main-navigation',
  content: '.entry-content, article, main',
  heading: 'h1, .entry-title'
};

module.exports = {
  PILLARS,
  LANGUAGES,
  SELECTORS
};
