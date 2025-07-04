<?php

return [
    "Docker makes it easy to isolate machine learning environments using containers.",
    "TensorFlow models can be packaged with dependencies in Docker images.",
    "Use a Dockerfile with CUDA base image to enable GPU acceleration in containers.",
    "PyTorch offers official Docker images for seamless experimentation and deployment.",
    "Scikit-Learn models can be containerized using slim Python images for efficiency.",
    "Use Docker Compose to run training and inference services together.",
    "Mount data volumes into Docker containers to separate model logic from datasets.",
    "You can deploy containerized ML apps to cloud platforms like AWS ECS or GCP Cloud Run.",
    "Containerize Jupyter notebooks for reproducible research environments.",
    "Dockerizing helps standardize environments across dev, staging, and production.",
    "Use `.dockerignore` to exclude datasets and logs from Docker builds.",
    "Optimize image size by using multi-stage builds in your Dockerfile.",
    "Keep model weights in mounted volumes or download at container start for portability.",
    "Use environment variables for flexible model configuration inside Docker.",
    "Docker simplifies CI/CD for ML projects with reproducible builds.",
    "Use Docker health checks to monitor running inference services.",
    "Dockerfiles should pin package versions to avoid unexpected behavior.",
    "You can run multiple model versions in parallel containers behind a reverse proxy.",
    "Use minimal base images like `python:3.10-slim` for Scikit-Learn apps.",
    "GPU-enabled containers require correct NVIDIA drivers and runtime configs.",
    "Track experiment configs using mounted YAML files for transparency.",
    "Docker Hub can host public ML containers for community reuse.",
    "Create a Makefile or script to simplify image builds and container runs.",
    "Run model training in background containers for long-running jobs.",
    "TensorFlow Serving and TorchServe both support Docker deployments.",
    "Avoid storing secrets or API keys directly in Docker images.",
    "Use volumes or cloud object storage for training data access.",
    "Log metrics to external services like MLflow from within Docker containers.",
    "Docker simplifies rollback in case of broken model builds.",
    "Use `docker stats` to monitor resource usage of running ML containers.",
    "Run GPU training containers with `--gpus all` flag in Docker CLI.",
    "Build versioned tags for ML containers to track experiment lineage.",
    "Prefer using `ENTRYPOINT` with arguments for command flexibility.",
    "Mount custom config files into Docker containers for each ML framework.",
    "Bind ports correctly for exposing APIs or Jupyter interfaces.",
    "Avoid downloading large datasets in Dockerfile — use run-time mounts.",
    "Build images that can support both CPU and GPU execution where possible.",
    "Use separate containers for preprocessing, model training, and serving.",
    "Label images with metadata about the training environment or dataset.",
    "Keep container logs concise — use external tools for full logging.",
];