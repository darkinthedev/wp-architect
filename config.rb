# Load in Susy Grid Layout Framework
require 'susy'

# Basic Configurations
css_dir = 'library/build/css'
sass_dir = 'library/scss'
javascripts_dir = 'library/js'
output_style = :compressed

## Image Handeling 
## Use the function for output in SASS file: image-url('file_name_here.gif')
#Sets image directory
images_dir = '/library/img'
#Sets output URL to be reletive to image directory
relative_assets = true
