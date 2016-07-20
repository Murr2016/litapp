FROM tutum/lamp:latest
RUN mkdir repo
RUN rm -fr /app && git clone https://github.com/Murr2016/litapp.git /repo && cp /repo/litapp /app
EXPOSE 80
CMD ["/run.sh"]
