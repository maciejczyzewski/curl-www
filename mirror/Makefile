ROOT = ..

SRCROOT=$(ROOT)/cvssource
DOCROOT=$(SRCROOT)/docs

include $(ROOT)/mainparts.mk
include $(ROOT)/setup.mk

all: index.html
	cd web; make

index.html: _index.html $(MAINPARTS)
	$(ACTION)

full: all

