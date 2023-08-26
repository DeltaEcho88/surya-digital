# test-surya-digital

## How To Use
Here's the steps how to use the plugins:

- Please install and activate Elementor on your wordpress site
- Please activate this plugins
- Create new page and edit with elementor
- Please search widgets called "Surya Digital Maps"
- Drag n Drop the widgets to the right side
- For API Key please insert Google Maps API
- For KML File please use the file that I've been re-create from your example file (or you can create a new file from google maps 😁)

## KML FILE
Since I can't access the file you provided in microsoft word, I tried to recreate the exact same file.

Here's the link of the file that maybe you can use:
  - https://drive.google.com/uc?id=1af1zAMBL84VHakLp3LzNa7gJZyePC53N&export=download
  - https://drive.google.com/uc?id=1mDJx8CBP_hEHqSyyE5NCfOgIkPaopRzH&export=download

## How It Works
I've create the function for extract the KML file to get the coordinates and recreate the polygon with the coordinates inside the file with Google Maps Polygon function. After that I use google maps function called "geometry.poly.containsLocation" for searching the places that have been searched on searchbox, when the places is exist it will used the Action Inside input and vice versa